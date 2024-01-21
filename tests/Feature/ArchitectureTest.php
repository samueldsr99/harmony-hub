<?php

it('checks that no dd, dump nor ray statements are used')
    ->expect(['dd', 'dump', 'ray'])->not()->toBeUsed();

it('checks that jobs are ran on the queue only')
    ->arch('app')->expect("App\Jobs")
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue');
