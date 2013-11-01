<?php
/**
 * StatusOfChoice model
 * Linked to StatusOfChoices in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *     belongsTo (Join Model) Choice
 *     belongsTo (Join Model) Status 
 */
class StatusOfChoice extends AppModel {
	public $name = 'StatusOfChoice';
	public $useTable = 'StatusOfChoices';
	public $primaryKey = 'StatusOfChoiceID';
	
	public $belongsTo = array(
		'Choice' => array(
			'className' => 'Choice',
			'foreignKey' => 'ChoiceID'
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'StatusID'
		)
	);
}