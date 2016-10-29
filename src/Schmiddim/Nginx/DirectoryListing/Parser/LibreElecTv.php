<?php


namespace Schmiddim\Nginx\DirectoryListing\Parser;


use GuzzleHttp\Client;

class LibreElecTv implements NginxLastItem
{

	protected $items = null;
	protected $baseUrl = null;

	/**
	 * LibreElecTv constructor.
	 */
	public function __construct($url)
	{

		$this->baseUrl = $url;
		$httpClient = new Client([
			'base_uri' => $this->getBaseUrl()
		]);
		$response = $httpClient->request('GET');
		$this->processItems((string)$response->getBody());

	}

	/**
	 * @return null|string
	 */
	public function getReleaseForToday()
	{
		$date = new \DateTime();
		$items = $this->getItems();
		$y = $date->format('Y');
		$m = $date->format('m');
		$d = $date->format('d');
		foreach ($items as $item) {
			if (preg_match_all("/$y$m$d/", $item)) {
				return $item;
			}
		}
		return null;
	}

	/**
	 * @param \DateTime|null $date
	 * @return string
	 */
	public function getLatestReleaseFromList(\DateTime $date = null)
	{
		if (null === $date) {
			$date = new \DateTime();
		}
		$items = $this->getItems();
		$y = $date->format('Y');
		$m = $date->format('m');
		$d = $date->format('d');
		foreach ($items as $item) {
			if (preg_match_all("/$y$m$d/", $item)) {
				return $item;
			}
		}
		return $this->getLatestReleaseFromList($date->sub(new \DateInterval('P1D')));


	}

	public function getItems()
	{
		return $this->items;
	}

	protected function processItems($body)
	{
		$output = [];


		preg_match_all('/<td><a href="[a-zA-Z0-9].*">/', $body, $output);

		array_walk($output[0], function (&$item) {
			$item = str_replace(['<td><a href="', '">'], '', $item);
		});


		foreach ($output[0] as $item) {
			$this->items[] = $this->getBaseUrl() . $item;

		}
	}

	/**
	 * @return string
	 */
	public function getBaseUrl()
	{
		return $this->baseUrl;
	}


}