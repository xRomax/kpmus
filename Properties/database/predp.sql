-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 19 2018 г., 16:31
-- Версия сервера: 5.6.38
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `predp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `autopark`
--

CREATE TABLE `autopark` (
  `id` int(11) NOT NULL,
  `model` varchar(45) CHARACTER SET utf8 NOT NULL,
  `quantity` int(10) NOT NULL,
  `rdate` varchar(4) COLLATE utf8_latvian_ci NOT NULL,
  `price` varchar(45) CHARACTER SET utf8 NOT NULL,
  `last_date_teh` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Дамп данных таблицы `autopark`
--

INSERT INTO `autopark` (`id`, `model`, `quantity`, `rdate`, `price`, `last_date_teh`) VALUES
(1, 'BMW X6 xDrive 35i6', 3, '2008', '23 000 $', '2016-08-12'),
(2, 'Audi TT 2.0 TFSI S-tronic Quattro', 1, '2017', '60 000 $', '2017-12-01'),
(3, 'Машинка', 2, '2011', '50000', '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `docs`
--

CREATE TABLE `docs` (
  `id` tinyint(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(400) NOT NULL,
  `tags` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `username` varchar(60) NOT NULL,
  `sodr` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `username`, `sodr`, `date`) VALUES
(1, 'Новости!', 'xRomax', 'На сайте есть новостная лента!', '2018-05-13 14:15:38');

-- --------------------------------------------------------

--
-- Структура таблицы `otdels`
--

CREATE TABLE `otdels` (
  `id` int(11) NOT NULL,
  `name_otd` varchar(45) CHARACTER SET utf8 NOT NULL,
  `name_rukovod` varchar(200) CHARACTER SET utf8 NOT NULL,
  `kolv_sotr` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Дамп данных таблицы `otdels`
--

INSERT INTO `otdels` (`id`, `name_otd`, `name_rukovod`, `kolv_sotr`) VALUES
(1, 'Управління', 'Товмашенко Роман Федорович', 5),
(2, 'Відділ бухгалтерського обліку', 'Дуб Олена Миколаївна', 3),
(3, 'Відділ експлуатації', 'Хоменко Анатолій Анатолійович', 30),
(4, 'Загальний відділ', 'Кузьмина Ольга Олександрівна', 62),
(5, 'Транспортний відділ', 'Левченко Станіслав Олександрович', 21),
(6, 'Планово-договірний відділ', 'Юрчишина Ірина Сергіївна', 7),
(7, 'Інформаційно-телекомунікаційний відділ', 'Сіренький Петро Васильович', 2),
(8, '123', '123', 123);

-- --------------------------------------------------------

--
-- Структура таблицы `reg`
--

CREATE TABLE `reg` (
  `username` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `type` enum('admin','moder','user') NOT NULL,
  `status` enum('inactive','active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reg`
--

INSERT INTO `reg` (`username`, `login`, `pass`, `type`, `status`) VALUES
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'active'),
('Роман', 'xRomax', '4133275b6a937f1fb33e86e390d15e46', 'admin', 'active');

-- --------------------------------------------------------

--
-- Структура таблицы `rukovodstvo`
--

CREATE TABLE `rukovodstvo` (
  `id` int(11) NOT NULL,
  `otdel` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(45) CHARACTER SET utf8 NOT NULL,
  `pochta` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Дамп данных таблицы `rukovodstvo`
--

INSERT INTO `rukovodstvo` (`id`, `otdel`, `name`, `phone`, `pochta`) VALUES
(1, 'Управління', 'Товмашенко Роман Федорович', '7446282', 'kp.mus.dmr@gmail.com'),
(2, 'Відділ бухгалтерського обліку', 'Дуб Олена Миколаївна', '', ''),
(3, 'Відділ експлуатації', 'Хоменко Анатолій Анатолійович', '', ''),
(4, 'Загальний відділ', 'Кузьмина Ольга Олександрівна', '', ''),
(5, 'Транспортний відділ', 'Левченко Станіслав Олександрович', '', ''),
(6, 'Планово-договірний відділ', 'Юрчишина Ірина Сергіївна', '', ''),
(7, 'Інформаційно-телекомунікаційний відділ', 'Сіренький Петро Васильович', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `sklad`
--

CREATE TABLE `sklad` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `last_popoln` date NOT NULL,
  `quantity` int(45) NOT NULL,
  `daily_use` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Дамп данных таблицы `sklad`
--

INSERT INTO `sklad` (`id`, `name`, `last_popoln`, `quantity`, `daily_use`) VALUES
(1, 'Моющее средство Vanish, бутылка', '2017-12-01', 30, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `sotrudniki`
--

CREATE TABLE `sotrudniki` (
  `id` int(11) NOT NULL,
  `post` varchar(90) CHARACTER SET utf8 NOT NULL,
  `name` varchar(140) COLLATE utf8_latvian_ci NOT NULL,
  `oklad` int(11) NOT NULL,
  `phone` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Дамп данных таблицы `sotrudniki`
--

INSERT INTO `sotrudniki` (`id`, `post`, `name`, `oklad`, `phone`) VALUES
(1, 'Директор', 'Товмашенко Роман Федорович', 10000, '744-62-82'),
(2, 'Заступник директора', 'Нечепурук Роман Русланович', 9000, '744-62-82'),
(3, 'Заступник директора з фінансово-економічних питань', 'Шапар Вікторія Сергіївна', 9000, '744-62-82'),
(4, 'Провідний спеціаліст з ведення діловодства', 'Трощило Тетяна Вікторівна', 8000, '744-62-82'),
(5, 'Провідний спеціаліст (інженер з охорони праці)', 'Прокопенко Юрій Васильович', 8000, ''),
(6, 'Начальник відділу - головний бухгалтер', 'Дуб Олена Миколайвна', 9000, ''),
(7, 'Заступник начальника відділу - головного бухгалтера', 'Гончаренко Олена Михайлівна', 7500, ''),
(8, 'Заступник начальника відділу-менеджер з персоналу', 'Пономаренко Тетяна Леонідівна', 7500, ''),
(9, 'Провідний спеціаліст', 'Малишев Юрій Іванович', 7000, ''),
(10, 'Водій автотранспортних засобів', 'Коваленко Сергій Миколайович', 6000, ''),
(11, 'Начальник відділу', 'Юрчишина Ірина Сергіївна', 8000, ''),
(12, 'Провідний спеціаліст', 'Маляренко Сергій Володимирович', 7000, ''),
(13, 'Начальник відділу', 'Сіренький Петро Васильович', 8000, ''),
(14, 'Комірник', 'Сіренька Ірина Андріївна', 4500, ''),
(15, 'Водій автотранспортних засобів', 'Кравченко Сергій Вікторович', 6500, ''),
(16, 'Прибиральник службових приміщень', 'Кіріченко Лідія Яківна', 4000, ''),
(17, 'Прибиральник службових приміщень', 'Копачова Світлана Леонідівна', 4000, ''),
(18, 'Прибиральник службових приміщень', 'Кривошеєва Ніна Миколаївна', 4000, ''),
(19, 'Прибиральник службових приміщень', 'Радіонова Олена Сергіївна', 4000, ''),
(20, 'Прибиральник службових приміщень', 'Сидоренко Ольга Миколаївна', 4000, ''),
(21, 'Прибиральник службових приміщень', 'Борисенко Лідія Василівна', 4000, ''),
(22, 'Прибиральник службових приміщень	', 'Макашова Алла Іванівна	', 4000, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name_rus` varchar(100) NOT NULL,
  `name_eng` varchar(100) NOT NULL,
  `access` set('admin','moder','user','') NOT NULL,
  `cols_name` text NOT NULL,
  `cols_name_rus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tables`
--

INSERT INTO `tables` (`id`, `name_rus`, `name_eng`, `access`, `cols_name`, `cols_name_rus`) VALUES
(1, 'Автопарк', 'autopark', 'admin,moder,user', 'id,model,quantity,rdate,price,last_date_teh', '№,Модель,Количество,Дата выпуска,Дата последнего тех обсл'),
(2, 'Отделы', 'otdels', 'admin,moder,user', 'id,name_otd,name_rukovod,kolv_sotr', '№,Название отдела,Имя руководителя,Количество сотрудников'),
(3, 'Пользователи', 'reg', 'admin', 'username,login,pass,type,status', 'Имя пользователя,Логин,Пароль,Тип аккаунта,Статус'),
(4, 'Руководство', 'rukovodstvo', 'admin,moder,user', '№,otdel,name,phone,pochta', '№,Отдел,Имя,Телефон,Почта'),
(5, 'Склад', 'sklad', 'admin,moder,user', 'id,name,last_popoln,quantity,daily_use', '№,Название,Последнее пополнение,Количество,Дневное использование'),
(6, 'Сотрудники', 'sotrudniki', 'admin,moder', 'id,post,name,oklad,phone', '№,Должность,Имя,Оклад,Телефон'),
(7, 'Закупка', 'zakupka', 'admin,moder,user', 'id,description,start_accepting,end_accepting,status,price', '№,Описание,Начало закупки,Конец закупки,Статус,Сумма');

-- --------------------------------------------------------

--
-- Структура таблицы `zakupka`
--

CREATE TABLE `zakupka` (
  `id` varchar(30) COLLATE utf8_latvian_ci NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `start_accepting` date NOT NULL,
  `end_accepting` date NOT NULL,
  `status` varchar(45) CHARACTER SET utf8 NOT NULL,
  `price` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Дамп данных таблицы `zakupka`
--

INSERT INTO `zakupka` (`id`, `description`, `start_accepting`, `end_accepting`, `status`, `price`) VALUES
('UA-2017-12-26-001872-b', 'Технічне обслуговування АТС', '2017-12-29', '2018-01-03', 'Очікування пропозицій', '30 000 ₴'),
('UA-2017-12-29-002140-c', 'Вітражні конструкції', '2017-12-29', '2018-01-17', 'Очікування пропозицій', '615 000 ₴'),
('UA-2017-12-28-002116-b', 'Автомобільні шини (зимні)', '2018-01-02', '2018-01-03', 'Період уточнень', ' 49 000 ₴'),
('UA-2017-12-27-000165-b', 'Капітальний ремонт двох пасажирських ліфтів в адміністративній будівлі за адресою: просп. Дмитра Яворницького, 75 у м. Дніпро (заміна двох пасажирських ліфтів)', '2017-12-27', '2018-01-20', 'Очікування пропозицій', ' 3 125 000 ₴'),
('UA-2017-12-26-002360-b', 'Послуга з ремонту і технічного обслуговування оходжувальних установок', '2017-12-29', '2018-01-03', 'Очікування пропозицій', '90 000 ₴'),
('UA-2017-12-26-001857-b', 'Технічне обслуговування ліфтів', '2017-12-29', '2018-01-03', 'Очікування пропозицій', '155 000 ₴'),
('UA-2017-12-22-003730-b', 'Закупівля природного газу, з урахуванням його транспортування магістральними трубопроводами', '2017-12-28', '2018-01-02', 'Очікування пропозицій', '199 691,31 ₴'),
('UA-2017-12-15-004578-b', 'Виставкове обладнання', '2017-12-15', '2018-01-02', 'Очікування пропозицій', '450 000 ₴'),
('UA-2015-12-16-000076', '	 Послуги по ремонту і ТО системи контолю доступу', '2015-12-16', '2015-12-28', 'Пропозиції розглянуто', '8 000 ₴'),
('UA-2015-12-16-000073', 'Послуги по ремонту і ТО системи відеоспостереження', '2015-12-16', '2015-12-28', 'Пропозиції розглянуто', '8 000 ₴');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `autopark`
--
ALTER TABLE `autopark`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `docs`
--
ALTER TABLE `docs`
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `otdels`
--
ALTER TABLE `otdels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reg`
--
ALTER TABLE `reg`
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Индексы таблицы `rukovodstvo`
--
ALTER TABLE `rukovodstvo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_rus` (`name_rus`),
  ADD UNIQUE KEY `name_eng` (`name_eng`);

--
-- Индексы таблицы `zakupka`
--
ALTER TABLE `zakupka`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `docs`
--
ALTER TABLE `docs`
  MODIFY `id` tinyint(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
