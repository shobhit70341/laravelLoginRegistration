@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    @php
                    
                    function countWords($str)
                    {
                        $wordCount = 0;
                        $isInsideQuote = false;

                        $length = strlen($str);
                        for ($i = 0; $i < $length; $i++) {
                            $char = $str[$i];

                            if ($char == "'") {
                                // Toggle the inside quote flag
                                $isInsideQuote = !$isInsideQuote;
                            } elseif ($char == ' ' && !$isInsideQuote) {
                                // Increment the word count if not inside quote and encountering a space
                                $wordCount++;
                            }
                        }

                        // Increment the word count by 1 for the last word or if the string doesn't end with a space
                        $wordCount++;

                        return $wordCount;
                    }

                    $str = "Lorem ipsum dolor sit amet 'consectetur adipiscing' elit, litora 'enim cum tellus' nisl 'ridiculus senectus' natoque, 'eros' vestibulum mauris aenean tempus lobortis. Accumsan 'volutpat semper auctor' tincidunt";

                    $wordCount = countWords($str);
                    
                    @endphp
                    <pre>

                    function countWords($str)
                    {
                        $wordCount = 0;
                        $isInsideQuote = false;

                        $length = strlen($str);
                        for ($i = 0; $i < $length; $i++) {
                            $char = $str[$i];

                            if ($char == "'") {
                                // Toggle the inside quote flag
                                $isInsideQuote = !$isInsideQuote;
                            } elseif ($char == ' ' && !$isInsideQuote) {
                                // Increment the word count if not inside quote and encountering a space
                                $wordCount++;
                            }
                        }

                        // Increment the word count by 1 for the last word or if the string doesn't end with a space
                        $wordCount++;

                        return $wordCount;
                    }

                    $str = "Lorem ipsum dolor sit amet 'consectetur adipiscing' elit, litora 'enim cum tellus' nisl 'ridiculus senectus' natoque, 'eros' vestibulum mauris aenean tempus lobortis. Accumsan 'volutpat semper auctor' tincidunt";

                    {{ "Number of words: " . $wordCount; }}

                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
