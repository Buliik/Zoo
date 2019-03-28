<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model;



class CoopPresenter extends BasePresenter
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
  

protected function createComponentCoopForm() 
    {
      $form = new Form;
      $vybeh = array(
          'Klec' => 'Klec',
          'Akvarium' => 'Akvarium',
          'Vybeh' => 'Vybeh',
      );
      $form->addText('tools', 'Potřebné pomůcky:');  
      $form->addSelect('type', 'Typ výběhu: *', $vybeh);
      $form->addSubmit('save', 'Uložit');
      $form->onSuccess[] = array($this, 'coopFormSucceeded');
      return $form; 
    }

 
 
 
 public function coopFormSucceeded(Form $form)
	{
    if($this->getParameter('id') > 0) 
      {$this->database->table('vybeh')->get($this->getParameter('id'))->update($form->getValues(TRUE));} 
    else 
      {$this->database->table('vybeh')->insert($form->getValues(true));} 
    $this->redirect('default');
	} 

    
    
    
	public function renderDefault()
	{
  
		$this->template->anyVariable = 'any value';
    $this->template->coops = $this->database->table('vybeh');
	}
  
  public function renderAdd()
	{
    
		$this->template->anyVariable = 'any value';
	}
  
  public function renderEdit($id)
	{
    $this->template->coop=$this->database->table("vybeh")->where('id = ?', $id)->fetch();
    $coop=$this->database->table("vybeh")->where('id = ?', $id)->fetch();
    $this["coopForm"]->setDefaults($coop);
	}
  
  public function handleDelete($id) 
  { 
    $this->database->table("vybeh")->where('id = ?', $id)->delete($id);
    $this->redirect("default"); 
  }

}