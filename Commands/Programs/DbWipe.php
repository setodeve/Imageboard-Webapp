<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class DbWipe extends AbstractCommand
{
    protected static ?string $alias = 'dbwipe';

    public static function getArguments(): array
    {
        return [
          (new Argument('backup'))->description('backup practice_db')->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $backup = $this->getArgumentValue('backup');
        if ($backup==true){
          shell_exec("mysqldump practice_db > backup.sql");
          $this->log('Backupping.......');
        }else{
          shell_exec("mysql practice_db < backup.sql");
          $this->log('Restoring.......');
        }
        
        return 0;
    }
}