<?php
class StudentsController extends AppController{
	// Use Paginate
	var $helpers = array('Paginator','Html');
	var $paginate = array();

	public function index(){
		 // if search name of student -> find with $search value
		 if ( isset($this->request->query['search']) ) {
			 $sSearch = $this->request->query['search'];
			 $this->paginate = array(
				             'limit' => 4 ,
				             'order' => array(
				             	'id' => 'asc'
							 ),
				             'conditions' => array(
				             	'Student.name LIKE'=> "%$sSearch%"
							 )
			 );
		 // if no search -> find all
		 }   else {
			 $this->paginate = array(
				 'limit' => 4,
				 'order' => array(
					 'id' => 'asc'
				 ),
			 );
		 }
		 // Set up conditions, JOIN for Paginate
		 $this->paginate['joins'] = array(
			                      array(
				                    'type' => 'INNER',
				                    'table' => 'genders',
				                    'alias' => 'genders',
				                    'conditions' => 'student.gender = genders.id',
								  )
		 );
		 $this->paginate['fields'] = array('student.*,genders.gender');
		 $students = $this->paginate("Student");
		 $this->set("students",$students);
	 }

	 // Add new student
	public function add(){
		 if ( $this->request->is('post') ) {
		 	 $this->Student->create();
		 	 if ( $this->Student->save($this->request->data) ) {
		 		 $this->redirect( array(
							'controller' => 'students',
							'action' => 'index',
					  )
				 );
		 	 }
		 }
	}

	// Delete Student
	function delete($iStudentId){
		// Check role of User, only admin can delete student
		if( $this->Auth->user('role') == 'admin' ) {
			if( $this->Student->delete($iStudentId) ) {
				$this->redirect(array(
						'controller' => 'students',
						'action' => 'index',
					)
				);
			}
		} else {
			$this->Flash->error(__('Only admin can delete student'));
		}
	}

	// Edit Student Info
	function edit($iStudentId){
		// Get data of want-to-edit student, and set on view to show student's data
		$student = $this->Student->query(
			" SELECT students.*, genders.* FROM students
				    JOIN genders ON students.gender = genders.id
				    WHERE students.id = $iStudentId "
		);
		$this->set('students',$student);
		//Edit: Check role of User, only admin can delete student
		if( $this->request->is('post') ) {
			if( $this->Auth->user('role') == 'admin' ) {
				$this->Student->id = $iStudentId;
				if ( $this->Student->save($this->request->data) ) {
					$this->redirect(array(
							'controller' => 'students',
							'action' => 'index',
						)
					);
				}
			} else {
				$this->Flash->error(__('Only admin can edit student'));
			}
		}
	}
}
?>
