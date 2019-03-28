<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model;
use Nette\Security\Passwords;



class MedicPresenter extends BasePresenter
{
     /**
     * @var \Nette\Database\Context
     * @inject
     */
    private $database;     


   public function __construct(Nette\Database\Context $database)
     {
      $this->database = $database;
     }
  


  protected function createComponentMedicForm() 
    {
        $form = new Form;
        $position = array(
          'admin' => 'Administrátor',
          'user' => 'Ošetřovatel',
      );
        $form->addText('rc', 'Rodné číslo: *')
          ->addRule(Form::INTEGER, 'Zadejte prosím číslo.')
          ->setRequired('Zadejte prosím rodné číslo.');
        $form->addText('jmeno', 'Jméno: *')
          ->setRequired('Zadejte prosím jméno.');
        $form->addText('prijmeni', 'Přijmení: *')
          ->setRequired('Zadejte prosím příjmení.');        
        $form->addSelect('role', 'Pozice: *', $position);         
        $form->addPassword('password', 'Heslo: ');
        $form->addPassword('passwordVerify', 'Heslo pro kontrolu: ')
          ->setOmitted();  
        $form->addText('vzdelani', 'Dosažené vzdělání:');
        $form->addSubmit('register', 'Uložit');
        //$form->onValidate[] = array($this,'verifyRC');
        $form->onSuccess[] = array($this, 'registrationFormSucceeded');
        return $form; 
    }

         
 public function beforeRender()
 {
  if($this->getUser()->getIdentity()->role == "user") $this->redirect("Homepage:default"); 
 }          
 
 public function registrationFormSucceeded(Form $form)
	{
    $values=$form->getValues(TRUE);
    $values["password"] = Passwords::hash($values["password"]);
    if($this->getParameter('rc') > 0) 
      {$this->database->table('osetrovatel')->get($this->getParameter('rc'))->update($values);} 
    else 
      {$this->database->table('osetrovatel')->insert($values);}
    $this->redirect('default');
	}   
    
    
	public function renderDefault()
	{
  
		$this->template->anyVariable = 'any value';
    $this->template->medics = $this->database->table('osetrovatel');
	}
  
  public function renderAdd()
	{
    
		$this->template->anyVariable = 'any value';
	}
  
  public function renderEdit($rc)
	{
    $this->template->medic=$this->database->table("osetrovatel")->where('rc = ?', $rc)->fetch();
    $medic=$this->database->table("osetrovatel")->where('rc = ?', $rc)->fetch();
    $this["medicForm"]->setDefaults($medic);
	}
  
  public function handleDelete($rc) 
  { 
    $this->database->table("osetrovatel")->where('rc = ?', $rc)->delete($rc); 
    $this->redirect("default"); 
  }

}