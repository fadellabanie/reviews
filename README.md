# reviews

Files of Laravel Project 

1. Model files 
    1. Reante
    2. Booking
    3. Review
2. Migration files
  1.Rentes Table
  2.Bookings Table
  3.Reviws Table
3. Factories
  1.Rente Factorie
  2.Review Factorie
  3.Booking Factorie
  
4. Controller File
  1. ReviewController 
Controller file have 4 functions each function have difference souliation and Cost time - size


Code in DatabaseSeeder file To generate Fake Date

  Renter::factory()->count(5)->create()->each(function ($renter) {
            Booking::factory($renter)->count(5)->create([
                'renter_id' => $renter->id,
            ])->each(function ($booking) {
                Review::factory($booking)->count(5)->create([
                    'booking_id' => $booking->id,
                ]);
            });
        });
        
 
