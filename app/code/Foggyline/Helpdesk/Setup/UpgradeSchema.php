<?php

namespace Foggyline\Helpdesk\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

//        var_dump((version_compare($context->getVersion(), '1.0.7', '<')));
//        var_dump($context->getVersion());
//        die('ccc');
//       if (version_compare($context->getVersion(), '1.0.7', '<')) {
           $this->upgrade101($setup);
//       }
    }

    protected function upgrade101($setup)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('foggyline_helpdesk_post')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('foggyline_helpdesk_post')
            )
                ->addColumn(
                    'post_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Post ID'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Post Name'
                )
                ->addColumn(
                    'url_key',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post URL Key'
                )
                ->addColumn(
                    'post_content',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Post Post Content'
                )
                ->addColumn(
                    'tags',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Tags'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    1,
                    [],
                    'Post Status'
                )
                ->addColumn(
                    'featured_image',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Featured Image'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At')
                ->setComment('Post Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('mageplaza_helloworld_post'),
                $setup->getIdxName(
                    $installer->getTable('mageplaza_helloworld_post'),
                    ['name', 'url_key', 'post_content', 'tags', 'featured_image'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'url_key', 'post_content', 'tags', 'featured_image'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}