<?

namespace Classes;

class Questions_simple extends Questions{
    private $listereponse;
    private $reponse;
    public  function  get_reponse(){
        return $this->reponse;
    }
    public function verif_reponse(string $reponse){
        return $this->reponse === $reponse;
    }
    public function set_reponse(string $reponse){
        $this->reponse = $reponse;
    }
    public function __construct(string $uuid, string $label, array $listereponse, string $reponse){
        $this->uuid = $uuid;
        $this->label = $label;
        $this->listereponse = $listereponse;
        $this->reponse = $reponse;

    }public function render(): string {
        $res = '<h2>' . $this->label . '</h2>';
        foreach ($this->listereponse as $reponse) {
            $res .= '<input type="radio" name="' . $this->uuid . '" value="' . $reponse . '">' . $reponse . '<br>';
        }
        return $res;
    }
    
}

?>