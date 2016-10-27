<?php


namespace Schmiddim\Nginx\DirectoryListing;


class Parse
{

	protected $items = null;
	protected $baseUrl = null;

	public function __construct($baseUrl, $body)
	{
		$this->setBaseUrl($baseUrl);
		$this->processItems($body);

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

		$bar = 1;
	}


	protected function getBaseUrl()
	{
		return $this->baseUrl;
	}


	protected function setBaseUrl($baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}


}