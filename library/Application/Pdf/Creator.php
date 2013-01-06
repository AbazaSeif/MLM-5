<?php
/**
 * MLM System
 *
 * @author    Adrian Wądrzyk <adrian.wadrzyk@gmail.com>
 * @copyright 2012 Adrian Wądrzyk. All rights reserved.
 */

namespace Application\Pdf;

use Model\SettlementTotal;
use Application\Entity\EntityManager;

class Creator
{
    /**
     * Settlement
     *
     * @var SettlementTotal
     */
    private $_settlement;

    /**
     * Pdf
     *
     * @var \Zend_Pdf
     */
    private $_pdf;

    public function __construct(SettlementTotal $settlement)
    {
        $this->_settlement = $settlement;
        $this->_pdf = new \Zend_Pdf();
    }

    /**
     * Creates new pdf page
     *
     * @return \Zend_Pdf_Page
     */
    protected function newPage()
    {
        $page = new \Zend_Pdf_Page(\Zend_Pdf_Page::SIZE_A4_LANDSCAPE);
        return $page;
    }

    protected function setFont(\Zend_Pdf_Page $page, $size = 12)
    {
        $basePath = APPLICATION_PATH . "/../public/fonts/";
        $font = \Zend_Pdf_Font::fontWithPath($basePath . 'LiberationSans-Regular.ttf');
        $page->setFont($font, $size);
    }


    protected function createHeader(\Zend_Pdf_Page $page)
    {
        $filename = APPLICATION_PATH . "/../public/images/invoice-logo.png";
        $image = new \Zend_Pdf_Resource_Image_Png($filename);
        $page->drawImage($image, 30, 533, 210, 560);

        $this->createSeller($page);
    }

    protected function createSeller(\Zend_Pdf_Page $page)
    {
        $this->setFont($page, 12);
        $page->drawText("Rozliczenie  " . $this->_settlement->createDate, 75, 475);
        $employee = $this->_settlement->employee;

        $page->drawText("Pracownik:   " . $employee->lastname . " " . $employee->firstname, 75, 455, 'UTF-8');
        $page->drawText("Stanowisko: " . $employee->position->name, 75, 435, 'UTF-8');
    }

    protected function createContent(\Zend_Pdf_Page $page)
    {
        $page->setLineWidth(2);
        $page->drawLine(30, 400, 810, 400);

        $em = EntityManager::getInstance();
        $where = "settlement_total_id = " . $this->_settlement->getIdentifier();

        $settlements = $em->findAll("Settlement", $where);
        $lines = count($settlements) + 1;

        $this->setFont($page);
        $page->drawText("Lp.", 40, 383);
        $page->drawText("Nazwisko i imię klienta", 90, 383, "UTF-8");
        $page->drawText("Partner", 270, 383);
        $page->drawText("Produkt", 390, 383);
        $page->drawText("Transza", 520, 383);
        $page->drawText("Kwota", 625, 383);
        $page->drawText("Forma wynagrodzenia", 685, 383);

        $lineHeight = 25;
        for ($i = 0; $i <= $lines; $i++) {
            $page->drawLine(30, 400 - $i * $lineHeight, 810, 400 - $i * $lineHeight);
            if ($i > 0 && $i < $lines) {
                $settlement = $settlements[$i - 1];

                $page->drawText($i, 45, 383 - $i * $lineHeight);
                $customer = $settlement->application->customer->lastname . ' ' .
                            $settlement->application->customer->firstname;

                $page->drawText($customer, 80, 383 - $i * $lineHeight, "UTF-8");
                $page->drawText($settlement->application->partner->name, 240, 383 - $i * $lineHeight, "UTF-8");
                $page->drawText($settlement->application->product->name, 360, 383 - $i * $lineHeight, "UTF-8");
                $page->drawText($settlement->parts, 480, 383 - $i * $lineHeight, 'UTF-8');
                $page->drawText($settlement->amount, 630, 383 - $i * $lineHeight);
                $page->drawText($settlement->application->settlementType->name, 725, 383 - $i * $lineHeight);
            }
        }

        $bottomY = 383 - $i * $lineHeight + $lineHeight;

        $page->drawLine(30, 400, 30, 400 - $lines * $lineHeight);
        $page->drawLine(70, 400, 70, 400 - $lines * $lineHeight);

        $page->drawLine(230, 400, 230, 400 - $lines * $lineHeight);
        $page->drawLine(350, 400, 350, 400 - $lines * $lineHeight);
        $page->drawLine(470, 400, 470, 400 - $lines * $lineHeight);
        $page->drawLine(610, 400, 610, 400 - ($lines + 1) * $lineHeight);
        $page->drawLine(675, 400, 675, 400 - ($lines + 1) * $lineHeight);
        $page->drawLine(810, 400, 810, 400 - $lines  * $lineHeight);

        $page->drawLine(470, 400 - $lines * $lineHeight, 470, 400 - ($lines + 1) * $lineHeight);
        $page->drawLine(470, 400 - ($lines + 1) * $lineHeight, 675, 400 - ($lines + 1) * $lineHeight);
        $this->setFont($page);
        $page->drawText("Razem", 520, 383 - $lines * $lineHeight);
        $page->drawText($this->_settlement->total, 630, 383 - $lines * $lineHeight);
    }

    protected function createFooter(\Zend_Pdf_Page $page)
    {
        $this->setFont($page);
        $page->drawText("MLM System", 380, 10);
        $page->drawLine(10, 30, 830, 30);
    }

    public function render()
    {
        $page = $this->newPage();
        $this->createHeader($page);
        $this->createContent($page);
        $this->createFooter($page);

        $this->_pdf->pages[] = $page;
        return $this->_pdf->render();
    }
}