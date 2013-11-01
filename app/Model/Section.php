<?php
/**
 * Section model
 * Linked to Sections in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *     hasMany (Join Model) StatusOfSection
 *     hasMany Choice 
 */
class Section extends AppModel {
	public $name = 'Section';
	public $useTable = 'Sections';
	public $primaryKey = 'SectionID';
	
	public $hasMany = array(
		'Choice' => array(
			'className'	=> 'Choice',
			'foreignKey' => 'SectionID',
			'conditions' => array('Choice.OldFlag' => false),
			'dependent' => false
		),
		'StatusOfSection' => array(
			'className' => 'StatusOfSection',
			'foreignKey' => 'SectionID'
		) 
	);
}
