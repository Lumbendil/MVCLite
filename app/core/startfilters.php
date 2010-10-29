<?php
/**
 * startfilters.php
 *
 * File wich starts all the filters that get rid of the super global variable after
 * storing the data, to avoid direct usage.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
FilterSingletonFactory::getInstance('FilterCookie');
FilterSingletonFactory::getInstance('FilterGet');
FilterSingletonFactory::getInstance('FilterPost');
FilterSingletonFactory::getInstance('FilterRequest');