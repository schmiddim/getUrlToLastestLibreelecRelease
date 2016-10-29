<?php


namespace Schmiddim\Nginx\DirectoryListing\Parser;


interface NginxLastItem
{
	/**
	 * @return null|string
	 */
	public function getReleaseForToday();
	/**
	 * @param \DateTime|null $date
	 * @return string
	 */
	public function getLatestReleaseFromList();

}