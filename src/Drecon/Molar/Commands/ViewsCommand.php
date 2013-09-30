<?php namespace Drecon\Molar\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ViewsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'molar:views';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create molar views';

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
		$filePath = dirname(__DIR__).'/Files/Views/plans.blade.php';
		$targetPath = app_path().'/views/molar/plans.blade.php';

		if($this->createDirectory(app_path().'/views/molar')){

			if($this->copyFile($filePath,$targetPath)){
				$this->info("File created: $targetPath");
			}
			else{
				$this->error("Could not create file: $targetPath");
			}
		}
		else{
			$this->error("Could not create file: $targetPath");
		}
	}

	protected function createDirectory($path)
	{
		if(! \File::exists($path))
			return \File::makeDirectory($path);

		return false;
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