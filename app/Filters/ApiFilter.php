<?php 
namespace App\Filters;
 
use Illuminate\Http\Request;

//to [coulmn, operator, value]

class ApiFilter {
    //COLUMN
    protected $safeParms = [];

    protected $columnMap = [];

    //OPERATOR
    protected $operatorMap = [];

    public function transform (Request $request) {

        $eloQuery = [];

        foreach($this -> safeParms as $parm => $operators) {
            
            $query = $request->query($parm);
            if(!isSet($query)) continue;

            $column = $this->columnMap[$parm]??$parm;
        
            

            foreach ($operators as $operator) {

                if(isSet($query[$operator])) {
                    $eloQuery[] = [ 
                                    $column, //COLUMN
                                    $this-> operatorMap[$operator], // OPERATOR
                                    $query[$operator]//VALUE
                                  ]; 
                }
            }
        }
        return $eloQuery;
    }
}