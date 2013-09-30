<?php namespace Drecon\Molar\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SetUpCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'molar:setup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Setup molar';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		//copy config file
		$filePath = dirname(__DIR__).'/Files/Config/molar.php';
		$targetPath = app_path().'/config/molar.php';

		if($this->copyFile($filePath,$targetPath)){
			$this->info("File created: $targetPath");
		}
		else{
			$this->error("Could not create file: $targetPath");
		}
	}

	protected function copyFile($file,$target)
	{
		if(! \File::exists($target))
			return \File::copy($file,$target);

		return false;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}