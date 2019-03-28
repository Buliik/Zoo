<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model;



class TrainPresenter extends BasePresenter
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
  

  protected function createComponentTrainForm() 
   {
      $form = new Form;
      $kinds = array(
      'Výběhy' => array(
        'Klec' => 'Klec',
        'Akvarium' => 'Akvarium',
        'Vybeh' => 'Vybeh',
      ),
      'Zvířata' => array( 
      'bird' => 'Pták',
      'fish' => 'Ryba',
      'mammal' => 'Savec',
      ),
      );
      $form->addSelect('idpr', 'Ošetřovatel: *', $this->database->table('osetrovatel')->fetchPairs('rc', 'prijmeni'))
        ->setRequired('Zadejte prosím číslo pracovníka.')
        ->addRule(Form::INTEGER, 'Zadejte prosím číslo.');  
       $form->addSelect('druh', 'Druh: *', $kinds);   
      $form->addSubmit('save', 'Uložit');  
      $form->onSuccess[] = array($this, 'trainFormSucceeded');
      return $form; 
    } 

 
  public function beforeRender()
 {
  if($this->getUser()->getIdentity()->role == "user") $this->redirect("Homepage:default"); 
 }
 
 public function trainFormSucceeded(Form $form)
	{
    if($this->getParameter('id') > 0) 
      {$this->database->table('skoleni')->get($this->getParameter('id'))->update($form->getValues(TRUE));} 
    else 
      {$this->database->table('skoleni')->insert($form->getValues(true));}  
    $this->redirect('default');
	} 

    
    
    
	public function renderDefault()
	{
  
		$this->template->anyVariable = 'any value';
    $this->template->trains = $this->database->table('skoleni');
	}
  
  public function renderAdd()
	{    
		$this->template->anyVariable = 'any value';
	}
  
  public function renderEdit($id)
	{
    $this->template->train=$this->database->table("skoleni")->where('id = ?', $id)->fetch();
    $train=$this->database->table("skoleni")->where('id = ?', $id)->fetch();
    $this["trainForm"]->setDefaults($train);
	}

  public function handleDelete($id) 
  { 
    $this->database->table("skoleni")->where('id = ?', $id)->delete($id); 
    $this->redirect("default"); 
  }
}