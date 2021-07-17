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
use Hyperf\Utils\Str;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * @Command
 */
#[Command]
class StringRandomCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('str:random');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('随机生成密码');
        $this->addOption('length', 'L', InputOption::VALUE_OPTIONAL, '字符串长度');
    }

    public function handle()
    {
        $length = (int) $this->input->getOption('length');

        $this->output->writeln(
            Str::random($length ?: 6)
        );
    }
}
