<?php

namespace TheCoded\Utilities\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DowngradeVersionsToRequired extends Command
{
    private $dbVersionInfo;
    private $resourceConnection;

    public function __construct(
        \Magento\Framework\Module\DbVersionInfo $dbVersionInfo,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        $this->dbVersionInfo = $dbVersionInfo;
        $this->resourceConnection = $resourceConnection;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('setup:downgrade')
            ->setDescription('Downgrades modules schema and data versions to match requirements');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $errors = array_filter($this->dbVersionInfo->getDbVersionErrors(), function (array $error) {
            return isset($error['current'], $error['required'])
                && version_compare($error['current'], $error['required'], '>');
        });

        if (empty($errors)) {
            $output->writeln('Nothing to do.');

            return;
        }

        foreach ($errors as $error) {
            $setupModuleTable = $this->resourceConnection->getTableName('setup_module');
            $type = $error['type'];
            $column = $type.'_version';
            $currentValue = $error['current'];
            $requiredValue = $error['required'];
            $module = $error['module'];
            $sql = 'UPDATE '.$setupModuleTable.' SET `'.$column.'` = "'.$requiredValue.'" WHERE `module`="'.$module.'"';
            $output->writeln('Downgrading module '.$module.' ('.$type.') from '.$currentValue.' to '.$requiredValue.'.');
            $this->resourceConnection->getConnection()->query($sql);
        }
    }
}
