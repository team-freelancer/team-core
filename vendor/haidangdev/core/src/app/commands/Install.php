<?php 

namespace Haidangdev\Core\App\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use DB, Cache, Request, App;

class Install extends Command
{
	protected $name = 'admin:install';

	protected $description = 'Admin installation command';

	public function handle()
	{
		
		$this->info($this->description);
		$this->info('    ---***---');
		$this->info('Welcome to My Team');
		$this->info('    ---***---');

		if($this->confirm('Do you have setting the database configuration at .env ?')) {
			$this->info('Publishing files...');
			$this->callSilent('vendor:publish',['--force'=>true]);
			$this->info('Migrating database...');
			$this->call('migrate',[
				'--path' => 'database/migrations/admin/',
				'--force' => true,
			]);
			$this->info('Seeding database...');
			$this->call('db:seed');
			$this->call('cache:clear');
			$this->call('config:cache');
			$this->call('optimize');
			$this->info('Install Admin Is Done !');
		}else{
			$this->info('Please setting the database configuration for first !');
		}
	}
}