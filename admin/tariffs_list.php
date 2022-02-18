<?php
    // init assets
    wp_enqueue_style('dm_plugin_admin_style', plugin_dir_url(__FILE__) . 'assets/style.css');

    wp_enqueue_style('dmmodals-style', plugin_dir_url(__FILE__) . 'assets/dmmodal.css');
?>

<div class="tarif-list-page">
    <div class="header">
        <div class="title">
            <div class="logo">Тарифы</div>
            <div class="btn">Новый тариф</div>
        </div>
        <div class="panel">
            <div class="search">
                <div class="search-wrapper">
                    <input type="text">
                    <svg id="search-tariff" width="19" height="20" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2.96154" cy="2.96154" r="2.46154" fill="white" stroke="#C4C4C4" />
                        <line x1="4.6918" y1="5.06452" x2="7.38411" y2="8.29529" stroke="#C4C4C4" />
                    </svg>
                </div>
            </div>
            <div class="group-btn">
                <div data-modal-name="import-tariffs" data-modal-type="btn" class="import btn">Импортировать</div>
                <div class="export btn">Экспортировать</div>
            </div>
            <div class="md-modal" data-modal-name="import-tariffs" data-modal-title="Импорт тарифов" data-modal-type="btn">
                <div class="close-modal">
                    <img src="<?php echo plugin_dir_url(__FILE__) . 'assets/img/close.svg' ?>" alt="close modal">
                </div>
                <div class="modal-header">
                    header
                </div>
                <div class="modal-body">
                    body
                </div>
                <div class="modal-footer">
                    footer
                </div>
            </div>
        </div>
    </div>
        <div class="table">
            <div class="row header green">
                <div class="cell">
                    №
                </div>
                <div class="cell">
                    Название
                </div>
                <div class="cell">
                    Шаблон
                </div>
                <div class="cell">
                    Цена для квартир
                </div>
                <div class="cell">
                    Цена для частного сектора
                </div>
                <div class="cell">
                    Дата создания
                </div>
                <div class="cell">
                    Дата редактирования
                </div>
                <div class="cell">
                    Управление
                </div>
            </div>
            <div class="row">
                <div class="cell" data-title="Product">
                    1
                </div>
                <div class="cell" data-title="Unit Price">
                    Базовый
                </div>
                <div class="cell" data-title="Quantity">
                    v1
                </div>
                <div class="cell" data-title="Date Sold">
                    120
                </div>
                <div class="cell" data-title="Status">
                    -
                </div>
                <div class="cell" data-title="Status">
                    12.03.2022
                </div>
                <div class="cell" data-title="Status">
                    -
                </div>
                <div class="cell" data-title="Status">
                        <div class="action-tariff">
                            <div class="edit">✎</div>
                            <div class="delete">🗑</div>
                        </div>
                </div>
            </div>
        </div>
</div>
<div class="pagination">
    пагинация
</div>
</div>

<?php
    // 
    wp_register_script('dmmodals', plugin_dir_url(__FILE__) . 'assets/dmmodals.js');
    wp_enqueue_script('dmmodals');
?>