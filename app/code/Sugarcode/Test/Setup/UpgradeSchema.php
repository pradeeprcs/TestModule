<?php
 
namespace Sugarcode\Test\Setup;
 
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
		 $tableName = $setup->getTable('testtable');
		if (version_compare($context->getVersion(), '2.0.0') < 0) {
			// Changes here.
		}

		if (version_compare($context->getVersion(), '2.0.1', '<')) {
			
			// Changes here.
		}
		if (version_compare($context->getVersion(), '2.0.2', '<')) {
			  if ($setup->getConnection()->isTableExists($tableName) == true) {
				$connection = $setup->getConnection();
				/* $connection->addColumn(
					$tableName,
					'updated_at',
					['type' => Table::TYPE_DATETIME,'nullable' => false, 'default' => '', 'afters' => 'created_at'],
					'Updated At'
				); */
				$connection->changeColumn(
					$tableName,
					'summary',
					'short_summary',
					['type' => Table::TYPE_TEXT, 'nullable' => false, 'default' => ''],
					'Short Summary'
				);
				// Changes here.
			}
		}
		if (version_compare($context->getVersion(), '2.0.3', '<')) {
			  if ($setup->getConnection()->isTableExists($tableName) == true) {
				$connection = $setup->getConnection();
				
				  // Declare data
                $columns = [
                    'updated_at' => [
                        'type' => Table::TYPE_DATETIME,
                        'nullable' => false,
                        'comment' => 'Updated At',
						'after' => 'created_at',
                    ],
                ];

                $connection = $setup->getConnection();
                foreach ($columns as $name => $definition) {
                    $connection->addColumn($tableName, $name, $definition);
                }
				
				// Changes here.
			}
		}
		if (version_compare($context->getVersion(), '2.0.4', '<')) {
			  if ($setup->getConnection()->isTableExists($tableName) == true) {
				$connection = $setup->getConnection();
				
				  // Declare data
                $columns = [
                    'in_lists_grid' => [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => false,
                        'comment' => 'selected grids',
						'after' => 'updated_at',
                    ],
                ];

                $connection = $setup->getConnection();
                foreach ($columns as $name => $definition) {
                    $connection->addColumn($tableName, $name, $definition);
                }
				
				// Changes here.
			}
		}
		
		if (version_compare($context->getVersion(), '2.0.5', '<')) {
				$connection = $setup->getConnection();
				$tableNames=['sales_order_item','sales_invoice_item','quote_item'];
				
				  // Declare data
                $columns = [
                    'custom_sku' => [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => false,
						'LENGTH' =>255,
                        'comment' => 'custom sku',
                    ],
                ];
                $connection = $setup->getConnection();
                foreach ($tableNames as $tableName) {
					foreach ($columns as $name => $definition) {
						$connection->addColumn($tableName, $name, $definition);
					}
				}
				
				
				$tableNames=['sales_order','sales_invoice','quote'];
				
				  // Declare data
                $columns = [
                    'custom_field' => [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => false,
						'LENGTH' =>255,
                        'comment' => 'custom Field',
                    ],
                ];
                $connection = $setup->getConnection();
                foreach ($tableNames as $tableName) {
					foreach ($columns as $name => $definition) {
						$connection->addColumn($tableName, $name, $definition);
					}
				}
				
				
				// Changes here.
		}
		
		$setup->endSetup();
		
    }
}