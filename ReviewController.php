<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Renter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    # use faker laravel to generate data to make test
    # another solution in same case we can but renter foreign key in table reviews


    /**
     * use eloquent model laravel and relationships hasManyThrough in model .
     * Response Cost  time 96ms - get 25 rows  - size 3.98K
     */
    public function getUseEloquent()
    {
        return Renter::with(['reviews' => function ($q) {
            $q->select('public', 'privet');
        }])
            ->whereId(1) // <=== id of renter 
            ->get();
        ## Response 
        // [
        //     {
        //         "id": 1,
        //         "name": "Fletcher Rath",
        //         "address": "Deserunt ad eum accusamus culpa id quam.",
        //         "phone": "(346) 329-0887",
        //         "created_at": "2022-03-30T21:41:41.000000Z",
        //         "updated_at": "2022-03-30T21:41:41.000000Z",
        //         "reviews": [
        //             {
        //                 "public": "Aut exercitationem ut odio voluptatibus cum enim.",
        //                 "privet": "Et voluptates sunt ex explicabo occaecati consectetur.",
        //                 "laravel_through_key": 1
        //             },

    }
    /**
     * use DB Builder laravel and relationships DB Table .
     * Response Cost  time 58ms - get 25 rows  - size 5.6K
     */
    public function getUseDB()
    {
        return DB::table('renters as r')
            ->join('bookings as b', 'b.renter_id', '=', 'r.id')
            ->join('reviews as rv', 'rv.booking_id', '=', 'b.id')
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
        //     {
        //         "id": 1,
        //         "name": "Fletcher Rath",
        //         "address": "Deserunt ad eum accusamus culpa id quam.",
        //         "booking_id": 1,
        //         "public": "Aut exercitationem ut odio voluptatibus cum enim.",
        //         "privet": "Et voluptates sunt ex explicabo occaecati consectetur."
        //     },
    }

    /**
     * use MySql Query Inner Join.
     * Response Cost  time 13ms - get 25 rows 
     */
    public function getUseSqlWithInnerJoin()
    {
        //  select `r`.`id`, `r`.`name`, `r`.`address`, `rv`.`booking_id`, `rv`.`id`, `rv`.`public`, `rv`.`privet`
        //  from `renters` as `r` 
        //  inner join `bookings` as `b` on `b`.`renter_id` = `r`.`id`
        //  inner join `reviews` as `rv` on `rv`.`booking_id` = `b`.`id` 
        //  where `r`.`id` = 1
    }

    /**
     * use MySql Query Sub Query .
     * Response Cost  time 2.3ms - get 25 rows 
     */
    public function getUseSqlWithSubQuery()
    {
        // SELECT rv.id,
        //         rv.public,
        //         rv.privet
        //  FROM `reviews` AS `rv`,
        //       bookings AS b
        //  WHERE rv.booking_id In
        //      (SELECT b.id
        //       FROM bookings AS b
        //       WHERE b.renter_id =
        //           (SELECT r.id
        //            FROM renters AS r
        //            WHERE r.id = 1 ) )
        //  GROUP BY rv.id;
    }
}
