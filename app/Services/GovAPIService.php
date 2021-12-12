<?php

namespace App\Services;

use App\Exceptions\EmptyResponse;
use App\Repository\GovAPI\GovAPIRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class GovAPIService
 *
 * @package App\Services
 *
 * @author Beckhem <beckhem.meredith@hotmail.co.uk>
 */
class GovAPIService
{
    /**
     * Gov API repository interface
     *
     * @var GovAPIRepository $repository
     */
    private GovAPIRepository $repository;

    /**
     * GovAPIService constructor.
     *
     * @param GovAPIRepository $repository
     *
     * @return void
     */
    public function __construct(GovAPIRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Send request to API and return all new cases for given date,
     * if date is null then just use todays
     *
     * @return array
     *
     * @throws EmptyResponse
     */
    public function fetch(): array
    {
        $response = $this->repository->show($this->getEndpoint());

        if (is_null($response)) {
            throw new EmptyResponse('Empty Response from Gov API.');
        }

        $statData = [];

        Log::warning($response);

        // Gov API is crap so you cant limit how many results it sends back, we only care about last 2 days
        $statData['stats'] = array_slice(json_decode($response)->data, 0, 2, true);
        $statData['cumCasesByPublishDate'] = number_format(
            $statData['stats'][0]->cumCasesByPublishDate ?? $statData['stats'][1]->cumCasesByPublishDate,
            0
        );
        $statData['cumDeathsByDeathDate'] = number_format(
            $statData['stats'][0]->cumDeaths28DaysByPublishDate ?? $statData['stats'][1]->cumDeaths28DaysByPublishDate,
            0
        );
        $statData['cumPeopleVaccinatedCompleteByPublishDate'] = number_format(
            $statData['stats'][0]->cumPeopleVaccinatedCompleteByPublishDate ?? $statData['stats'][1]->cumPeopleVaccinatedCompleteByPublishDate,
            0
        );
        //$statData['percentVaccinated'] = ceil((Str::replaceFirst(',', '', $statData['cumPeopleVaccinatedCompleteByPublishDate']) / 179900 ) * 100);

        foreach ($statData['stats'] as $key => $value) {
            $statData['stats'][$key]->date = Carbon::parse($value->date)->format('jS F Y');
        }

        return $statData;
    }

    /**
     * Get the endpoint for the Gov Coronavirus API
     *
     * @return string
     */
    private function getEndpoint(): string
    {
        return sprintf(
            '%s?filters=areaType=ltla;areaCode=%s&structure=%s',
            config('govapi.url'),
            config('govapi.tf_code'),
            json_encode(
                [
                    'newCasesByPublishDate' => 'newCasesByPublishDate',
                    'date' => 'date',
                    'cumCasesByPublishDate' => 'cumCasesByPublishDate',
                    'newDeathsByDeathDate' => 'newDeathsByDeathDate',
                    'cumDeathsByDeathDate' => 'cumDeathsByDeathDate',
                    'cumDeaths28DaysByPublishDate' => 'cumDeaths28DaysByPublishDate',
                    'cumPeopleVaccinatedCompleteByPublishDate' => 'cumPeopleVaccinatedCompleteByPublishDate'
                ]
            )
        );
    }
}
