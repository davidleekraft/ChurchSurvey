<?php
/**
 * Status model
 * Linked to Statuses in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *     hasMany (Join Model) StatusOfChoice
 *     hasMany (Join Model) StatusOfSection
 */
class Status extends AppModel {
	public $name = 'Status';
	public $useTable = 'Statuses';
	public $primaryKey = 'StatusID';
	public $displayField = 'Type';

	public $hasMany = array(
		'StatusOfSection' => array(
			'className' => 'StatusOfSection',
			'foreignKey' => 'StatusID'
		),
		'StatusOfChoice' => array(
			'className' => 'StatusOfChoice',
			'foreignKey' => 'StatusID'
		)
	);
}
