<?php 

namespace Haidangdev\Core\App\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DB, Cache, Request, App;

class InitModule extends Command
{
	protected $name = 'module:init';

	protected $description = 'Admin module init command';

	public function handle()
	{
		$this->callSilent('make:model ',['--table'=>true]);
	}
}