<?php
namespace Game;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class PlayCommand extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this->setName("play:game")
             ->setDescription("Plays the Bee Game.")
             ->setHelp("You may enter the following commands in the console: hit");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hive = new Hive();

        $hive->add('Drone', 8);
        $hive->add('Worker', 5);
        $hive->add('Queen', 1);

        $output->writeln("Starting lifespan: " . $hive->getRemainingLifeSpan());

        $game = new Game($hive);

        do {
            $helper = $this->getHelper('question');
            $question = new Question('Enter a command: ', 'hit');
            $limit = $helper->ask($input, $output, $question);
            $response = $game->handleCommand($limit);
            $output->writeln($response);
        } while (!$game->isGameOver());

        $output->writeln('Game over');

    }
}