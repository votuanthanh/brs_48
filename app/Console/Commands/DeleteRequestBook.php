<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Contracts\RequestBookRepositoryInterface;

class DeleteRequestBook extends Command
{

    protected $requestBookRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete_request_book';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all book monthly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RequestBookRepositoryInterface $requestBookRepository)
    {
        parent::__construct();
        $this->requestBookRepository = $requestBookRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->requestBookRepository->deleteAcceptedBook();
    }
}
