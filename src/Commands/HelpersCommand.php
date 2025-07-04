<?php

namespace Backstage\Helpers\Commands;

use Illuminate\Console\Command;

class HelpersCommand extends Command
{
    public $signature = 'helpers';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
