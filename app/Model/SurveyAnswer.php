<?php
/**
 * SurveyAnswer model
 * Linked to SurveyAnswers in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *     belongsTo  Member
 *     belongsTo  Choice
 */
class SurveyAnswer extends AppModel {
	public $name = 'SurveyAnswer';
	public $useTable = 'SurveyAnswers';
	public $primaryKey = 'SurveyAnswerID';

	public $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'MemberID'
		),
		'Choice' => array(
			'className' => 'Choice',
			'foreignKey' => 'ChoiceID'
		)
	);
}