<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model;



class CleanPresenter extends BasePresenter
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
  

  protected function createComponentCleanForm() 
   {
      $form = new Form;
      $form->addSelect('idvy', 'Výběh: *', $this->database->table('vybeh')->fetchPairs('id', 'type'))
        ->setRequired('Zadejte prosím číslo výběhu.')
        ->addRule(Form::INTEGER, 'Zadejte prosím číslo.');
      $form->addSelect('idpr', 'Ošetřovatel: *', $this->database->table('osetrovatel')->fetchPairs('rc', 'prijmeni'))
        ->setRequired('Zadejte prosím číslo pracovníka.')
        ->addRule(Form::INTEGER, 'Zadejte prosím číslo.'); 
      $form->addText('beg', 'Začátek číštění: *'); 
      $form->addText('fin', 'Konec čištění: *');   
      $form->addSubmit('save', 'Uložit');  
      $form->onSuccess[] = array($this, 'cleanFormSucceeded');
      return $form; 
    } 

 
 
 
 public function cleanFormSucceeded(Form $form)
	{
    if($this->getParameter('id') > 0) 
      {$this->database->table('cisteni')->get($this->getParameter('id'))->update($form->getValues(TRUE));} 
    else 
      {$this->database->table('cisteni')->insert($form->getValues(true));}  
    $this->redirect('default');
	} 

    
    
    
	public function renderDefault()
	{
  
		$this->template->anyVariable = 'any value';
    $this->template->cleans = $this->database->table('cisteni');
	}
  
  public function renderAdd()
	{    
		$this->template->anyVariable = 'any value';
	}
  
  public function renderEdit($id)
	{
    $this->template->clean=$this->database->table("cisteni")->where('id = ?', $id)->fetch();
    $clean=$this->database->table("cisteni")->where('id = ?', $id)->fetch();
    $this["cleanForm"]->setDefaults($clean);
	}

  public function handleDelete($id) 
  { 
    $this->database->table("cisteni")->where('id = ?', $id)->delete($id); 
    $this->redirect("default"); 
  }
}