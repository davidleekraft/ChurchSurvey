<?php
/**
 * StatusOfSection model
 * Linked to StatusOfSection in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *     belongsTo (Join Model) Section
 *     belongsTo (Join Model) Status 
 */
class StatusOfSection extends AppModel {
	public $name = 'StatusOfSection';
	public $useTable = 'StatusOfSections';
	public $primaryKey = 'StatusOfSectionID';
	

	public $belongsTo = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'SectionID'
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'StatusID'
		)
	);
}