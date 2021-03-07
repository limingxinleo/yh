<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Command;

use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;
use function Han\Utils\date_load;

/**
 * @Command
 */
class TimeCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('t:fmt');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('时间戳转化');
        $this->addArgument('value', InputArgument::REQUIRED, '时间');
    }

    public function handle()
    {
        $value = $this->input->getArgument('value');

        $carbon = date_load($value);
        if (! $carbon) {
            $this->error('输入数据不是有效的时间参数');
            return;
        }

        $this->table(['时间戳', '时间'], [[
            $carbon->getTimestamp(),
            $carbon->toDateTimeString(),
        ]]);
    }
}
