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
		//copy views files
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

		$file2Path = dirname(__DIR__).'/Files/Views/moip_return_plans.blade.php';
		$target2Path = app_path().'/views/molar/moip_return_plans.blade.php';

		if($this->copyFile($file2Path,$target2Path)){
			$this->info("File created: $target2Path");
		}
		else{
			$this->error("Could not create file: $target2Path");
		}

		$file3Path = dirname(__DIR__).'/Files/Views/main_plans.blade.php';
		$target3Path = app_path().'/views/molar/main_plans.blade.php';

		if($this->copyFile($file3Path,$target3Path)){
			$this->info("File created: $target3Path");
		}
		else{
			$this->error("Could not create file: $target3Path");
		}

		$file4Path = dirname(__DIR__).'/Files/Views/main_checkout.blade.php';
		$target4Path = app_path().'/views/molar/main_checkout.blade.php';

		if($this->copyFile($file4Path,$target4Path)){
			$this->info("File created: $target4Path");
		}
		else{
			$this->error("Could not create file: $target4Path");
		}

		$file5Path = dirname(__DIR__).'/Files/Views/checkout.blade.php';
		$target5Path = app_path().'/views/molar/checkout.blade.php';

		if($this->copyFile($file5Path,$target5Path)){
			$this->info("File created: $target5Path");
		}
		else{
			$this->error("Could not create file: $target5Path");
		}

		$file6Path = dirname(__DIR__).'/Files/Views/infos.blade.php';
		$target6Path = app_path().'/views/molar/infos.blade.php';

		if($this->copyFile($file6Path,$target6Path)){
			$this->info("File created: $target6Path");
		}
		else{
			$this->error("Could not create file: $target6Path");
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