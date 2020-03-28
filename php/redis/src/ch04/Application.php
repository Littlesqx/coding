<?php

namespace Littlesqx\Redis\ch04;

use Littlesqx\Redis\AbstractApplication;

class Application extends AbstractApplication
{
    public function run()
    {
        $service = new SignService($this->redis);

        foreach (range(1, 10) as $id) {
            $service->signOn($id);
        }

        var_dump($service->getWeeklyStatistics());
        var_dump($service->getMonthlyStatistics());
    }
}