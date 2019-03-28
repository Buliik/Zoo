<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model;



class AnimalPresenter extends BasePresenter
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
  

protected function createComponentAnimalForm()
    {
      $form = new Form;
      $kinds = array(
      'bird' => 'Pták',
      'fish' => 'Ryba',
      'mammal' => 'Savec',
      );
      $form->addText('jmeno', 'Jméno:');  
      $form->addText('occurence', 'Výskyt:');
      $form->addSelect('druh', 'Druh:', $kinds); 
      $form->addText('bd', 'Datum narození:');  
      $form->addSelect('idvy', 'Výběh: *', $this->database->table('vybeh')->fetchPairs('id', 'type'))
        ->setRequired('Zadejte prosím číslo výběhu.')
        ->addRule(Form::INTEGER, 'Zadejte prosím číslo.');
      $form->addSubmit('save', 'Uložit');
      $form->onSuccess[] = array($this, 'animalFormSucceeded');
      return $form; 
    }  

 
 
 
 public function animalFormSucceeded(Form $form)
	{
    if($this->getParameter('id') > 0) 
      {$this->database->table('zvire')->get($this->getParameter('id'))->update($form->getValues(TRUE));} 
    else 
      {$this->database->table('zvire')->insert($form->getValues(true));}
    $this->redirect('default');
	} 

    
    
    
	public function renderDefault()
	{
  
		$this->template->anyVariable = 'any value';
    $this->template->animals = $this->database->table('zvire');
	}
  
  public function renderAdd()
	{
    
		$this->template->anyVariable = 'any value';
	}
  
  public function renderEdit($id)
	{
    $this->template->animal=$this->database->table("zvire")->where('id = ?', $id)->fetch();
    $animal=$this->database->table("zvire")->where('id = ?', $id)->fetch();
    $this["animalForm"]->setDefaults($animal);
	}
  
  public function handleDelete($id) 
  { 
    $this->database->table("zvire")->where('id = ?', $id)->delete($id); 
    $this->redirect("default"); 
  }

}