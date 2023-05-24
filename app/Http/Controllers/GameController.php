<?php

namespace App\Http\Controllers;

use App\Models\Ball;
use App\Models\Bucket;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balls = Ball::latest()->paginate(5);
        $buckets = Bucket::latest()->paginate(5);
        $filledBuckets = [];

        return view("index", compact('balls','buckets','filledBuckets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function distribute(Request $request){

        // print_r($request->all()['records']); die;

        $ballsByColor = $request->all()['records'];

        // foreach($reqdata as $req){
          
        //     $b_id = $req['id'];
        //     $ballsdata = Ball::findOrFail($b_id);
        // }
        // die;
        // $ballsByColor = $ballsdata;
        $buckets = Bucket::all();
        $balls = Ball::all();

        // print_r($ballsByColor);  die;
        // print_r($buckets);
        $filledBuckets = [];

        // Call the fillBuckets function and display the result
        $filledBuckets = $this->fillBuckets($ballsByColor, $buckets);
        // print_r($filledBuckets); die;
        // Display the contents of each filled bucket
        if (is_array($filledBuckets)) {
            echo "<h2>RESULT</h2><br />\n";    
            echo "The buckets have been filled as follows:";
            echo "<br />\n";    
            foreach ($filledBuckets as $index => $bucket) {
                echo "Bucket " . $bucket['name'] .": (Capacity: " . $bucket['capacity'] . " inches):\n";
                foreach ($bucket['balls'] as $ball) {
                    echo "- Color: " . $ball['color'] . ", Size: " . $ball['size'] . " inches\n";
                }
                echo "<br />\n";    
            }
        } else {
            echo '';
        }
        // print_r($filledBucket); die;
        return view('index',compact('balls','buckets','filledBuckets'));
    }

// Function to calculate the total number of balls
function calculateTotalBalls($ballsByColor)
{
  
    $totalBalls = 0;
    foreach ($ballsByColor as $color => $ballData) {
        // print_r($ballData); 
        $totalBalls += $ballData['count'];
    }
    
    return $totalBalls;
}


// Function to fill the buckets with balls
function fillBuckets($ballsByColor, $buckets)
{
    $totalBalls = $this->calculateTotalBalls($ballsByColor);
    // Sort the buckets by capacity in descending order
   $buckets = collect($buckets)->sortBy('volume')->reverse()->toArray();
    
    // Iterate through each bucket and distribute the balls
    foreach ($buckets as $bucket) {
        $bucketCapacity = $bucket['volume'];
        $bucketName = $bucket['name'];
        $bktid = $bucket['id'];
    
        // Create a new bucket
        $filledBucket = [
            'id' => $bktid,
            'name' => $bucketName,
            'capacity' => $bucketCapacity,
            'balls' => [],
        ];
        // Iterate through each color of the balls
        foreach ($ballsByColor as $color => $ballData) {
            $count = $ballData['count'];
            $size = $ballData['volume'];
            $name = $ballData['name'];
            $id = $ballData['id'];

            // Calculate the number of balls that can fit in the bucket
            $ballsToAdd = min($count, floor($bucketCapacity / $size));
          
            // Add the balls to the bucket
            for ($i = 0; $i < $ballsToAdd; $i++) {
                $filledBucket['balls'][] = [
                    'color' => $name,
                    'size' => $size,
                ];
                $bucketCapacity -= $size;
                $count--;
            }
    
            // Update the remaining balls count and bucket capacity
            $ballsByColor[$id]['count'] = $count;
            // Check if the bucket is full
            if ($bucketCapacity <= 0) {
                break;
            }
        }
    
        // Add the filled bucket to the array of filled buckets
        $filledBuckets[] = $filledBucket;
    }
    // die;
    // print_r($filledBucket); die;
    return $filledBuckets;
}

}
