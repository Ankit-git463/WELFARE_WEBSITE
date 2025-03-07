CREATE TABLE `users` (
  `id` integer PRIMARY KEY,
  `firstname` varchar(255),
  `lastname` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `Aadhar` integer,
  `role` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `admin` (
  `id` integer PRIMARY KEY,
  `firstname` varchar(255),
  `lastname` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `Aadhar` integer,
  `phonenumber` integer,
  `role` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `buses` (
  `BusID` int PRIMARY KEY,
  `BusNumber` varchar(255),
  `RouteId` varchar(255),
  `Facalities` varchar(255),
  `Type` varchar(255),
  `Number_of_seats` integers
);

CREATE TABLE `Routes` (
  `RouteID` int PRIMARY KEY,
  `source` varchar(255),
  `destination` varchar(255),
  `BusNumber` varchar(255),
  `Journeytime` time
);
