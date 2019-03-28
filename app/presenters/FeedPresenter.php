<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Model;



class FeedPresenter extends BasePresenter
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
  

  protected function createComponentFeedForm() 
    {
      $form = new Form;
      $form->addSelect('idzv', 'Zvíře: *', $this->database->table('zvire')->fetchPairs('id', 'jmeno'))
        ->setRequired('Vyberte prosím zvíře.');  
      $form->addSelect('idpr', 'Ošetřovatel: *', $this->database->table('osetrovatel')->fetchPairs('rc', 'prijmeni'))
        ->setRequired('Zadejte prosím číslo pracovníka.'); 
      $form->addText('mnozstvi', 'Množství krmiva [g]:')
          ->addRule(Form::INTEGER, 'Zadejte prosím číslo.')
          ->setRequired('Zadejte prosím rodné číslo.'); 
      $form->addText('beg', 'Začátek krmení: *'); 
      $form->addText('fin', 'Konec krmení: *'); 
      $form->addSubmit('save', 'Uložit'); 
      $form->onSuccess[] = array($this, 'feedFormSucceeded');
      return $form; 
    } 

 
 
 
 public function feedFormSucceeded(Form $form)
	{
    if($this->getParameter('id') > 0) 
      {$this->database->table('krmeni')->get($this->getParameter('id'))->update($form->getValues(TRUE));} 
    else 
      {$this->database->table('krmeni')->insert($form->getValues(true));}
    $this->redirect('default');
	} 

    
    
    
	public function renderDefault()
	{
  
		$this->template->anyVariable = 'any value';
    $this->template->feeds = $this->database->table('krmeni');
	}
  
  public function renderAdd()
	{
    
		$this->template->anyVariable = 'any value';
	}
  
  public function renderEdit($id)
	{
    $this->template->feed=$this->database->table("krmeni")->where('id = ?', $id)->fetch();
    $feed=$this->database->table("krmeni")->where('id = ?', $id)->fetch();
    $this["feedForm"]->setDefaults($feed);
	}
  
  public function handleDelete($id) 
  { 
    $this->database->table("krmeni")->where('id = ?', $id)->delete($id);
    $this->redirect("default"); 
  }

}