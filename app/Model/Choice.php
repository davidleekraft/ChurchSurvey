<?php
/**
 * Choice model
 * Linked to Choices in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *     hasMany (Join Model) StatusOfChoice
 *     hasMany SuveyAnswer 
 */
class Choice extends AppModel {
	public $name = 'Choice';
	public $useTable = 'Choices';
	public $primaryKey = 'ChoiceID';

	public $belongsTo = array(
		'Section' => array(
			'className'		=> 'Section',
			'foreignKey'	=> 'SectionID',
			'conditions' 	=> array('Section.OldFlag' => false),
			'dependent'		=> false
		)
	);

	public $hasMany = array(
		'StatusOfChoice' => array(
			'className' => 'StatusOfChoice',
			'foreignKey' => 'ChoiceID'
		),
		'SurveyAnswer' => array(
			'className' => 'SurveyAnswer',
			'foreignKey' => 'ChoiceID'
		)
	);
}