<?php 
namespace App\Filters\v1;
 
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

//to [coulmn, operator, value]

class PostsFilter extends ApiFilter {
    //COLUMN
    protected $safeParms = [
        'userId' => ['eq'],
        'title' => ['eq'],
        'content' => ['eq'],
    ];

    protected $columnMap = [
        'userId' => 'user_id',
    ];

    //OPERATOR
    protected $operatorMap = [
        'eq' => '=',
    ];    

    }