<?php

/*
 * class Pagination for generating page-by-page navigation
 */

class Pagination
{

    /**
     *
     * @var links of navigation per page
     *
     */
    private $max = 10;

    /**
     *
     * @var key for GET, в который пишется номер страницы
     *
     */
    private $index = 'page';

    /**
     *
     * @var Current page
     *
     */
    private $current_page;

    /**
     *
     * @var Total number of entries
     *
     */
    private $total;

    /**
     *
     * @var Number of entries per page
     *
     */
    private $limit;

    /**
     * Running the necessary data for navigation
     * @param type $total <p>Total number of entries</p>
     * @param type $currentPage <p>Number of current page</p>
     * @param type $limit <p>Number of entries per page</p>
     * @param type $index <p>key for url</p>
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        # Set the total number of entries
        $this->total = $total;

        # Set the number of entries per page
        $this->limit = $limit;

        # set the key in url
        $this->index = $index;

        # Set the number of pages
        $this->amount = $this->amount();

        # set the number of current page
        $this->setCurrentPage($currentPage);
    }

    /**
     *  For links output
     * @return HTML with navigation links
     */
    public function get()
    {
        # for links recording
        $links = null;

        # get limit for the cycle
        $limits = $this->limits();

        $html = '<ul class="pagination">';
        # generate links
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # If page is the current page -> there is no link and added class active
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                # else generate the link
                $links .= $this->generateHtml($page);
            }
        }

        # if links are generated
        if (!is_null($links)) {
            # if current page is not first
            if ($this->current_page > 1)
                # create link to "first page"
                $links = $this->generateHtml(1, '&lt;') . $links;

            # if current page is not first
            if ($this->current_page < $this->amount)
                # create link to "last page"
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';

        # return html
        return $html;
    }

    /**
     * For generating of HTML-code of link
     * @param integer $page - number of the page
     *
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        # if is not set links text
        if (!$text)
            # set that text = number of page
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # Form the HTML code of the link and return
        return
            '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     *  For getting, where to start
     *
     * @return array with start and end of count
     */
    private function limits()
    {
        # Calculate the links on the left (for active link to be in the middle)
        $left = $this->current_page - round($this->max / 2);

        # Calculate starting point (начало отсчёта)
        $start = $left > 0 ? $left : 1;

        # If there is at least $this->max pages ahead
        if ($start + $this->max <= $this->amount) {
            # Assign the end of the cycle forward 5 pages or just a minimum
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # End - Total number of pages
            $end = $this->amount;

            # Start - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        # return
        return
            array($start, $end);
    }

    /**
     * To set the current page
     *
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # get the number of currect page
        $this->current_page = $currentPage;

        # if current page above 0
        if ($this->current_page > 0) {
            # If the current page is less than the total number of pages
            if ($this->current_page > $this->amount)
                # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
        } else
            # Setting the page to the last one
            $this->current_page = 1;
    }

    /**
     * To obtain the total number of pages
     *
     * @return number of pages
     */
    private function amount()
    {
        # divide and return
        return ceil($this->total / $this->limit);
    }

}
