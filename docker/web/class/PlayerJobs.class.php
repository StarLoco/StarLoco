<?php class PlayerJobs {

	public $name;
	public $currentJob;
	public $currentJobLvl;
	public $currentJobXp;
	public $otherJobs;
	
	public function __construct($name = null, $currentJob = null, $currentJobLvl = null, $currentJobXp = null, $otherJobs = null) {
		$this->name = $name;
		$this->currentJob = $currentJob;
		$this->currentJobLvl = $currentJobLvl;
		$this->currentJobXp = $currentJobXp;
		$this->otherJobs = $otherJobs;
	}
	
} ?>