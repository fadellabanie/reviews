<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Review2Controller extends Controller
{

    /**
     * use DB Builder laravel and relationships DB Table .
     * Response Cost  time 87ms - get 25 rows  - size 5.6K
     */
    public function getUseDB()
    {
        return DB::table('reviews as rv')
            ->join('bookings as b', 'b.id', '=', 'rv.booking_id')
            ->join('renters as r', 'r.id', '=', 'b.renter_id')
            ->where('r.id', 1)
            ->select(
                'r.id',
                'r.name',
                'r.address',
                'rv.booking_id',
                'rv.id',
                'rv.public',
                'rv.privet'
            )
            ->get();

        ## Response 
        // [
        // {
        //     "id": 1,
        //     "name": "Fletcher Rath",
        //     "address": "Deserunt ad eum accusamus culpa id quam.",
        //     "booking_id": 1,
        //     "public": "Aut exercitationem ut odio voluptatibus cum enim.",
        //     "privet": "Et voluptates sunt ex explicabo occaecati consectetur."
        //     },
        //     {
        //     "id": 2,
        //     "name": "Fletcher Rath",
        //     "address": "Deserunt ad eum accusamus culpa id quam.",
        //     "booking_id": 1,
        //     "public": "Cumque assumenda sed delectus.",
        //     "privet": "Non possimus rerum consequatur quo incidunt a officiis."
        //     },
    }

    /**
     * use MySql Query Inner Join.
     * Response Cost  time 8.1ms - get 25 rows 
     */
    public function getUseSqlWithInnerJoin()
    {
        // select `r`.`id`, `r`.`name`, `r`.`address`, `rv`.`booking_id`, `rv`.`id`, `rv`.`public`, `rv`.`privet`
        // from `reviews` as `rv`
        // inner join `bookings` as `b` on `b`.`id` = `rv`.`booking_id` 
        // inner join `renters` as `r` on `r`.`id` = `b`.`renter_id`
        // where `r`.`id` = ?
    }
}
