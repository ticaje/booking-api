# Booking Based API 

[![GPLv3 License](https://img.shields.io/badge/license-GPLv3-marble.svg)](https://www.gnu.org/licenses/gpl-3.0.en.html)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ticaje/booking-api.svg?style=flat-square)](https://packagist.org/packages/ticaje/booking-api)
[![Quality Score](https://img.shields.io/scrutinizer/g/ticaje/booking-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/ticaje/booking-api)
[![Total Downloads](https://img.shields.io/packagist/dt/ticaje/booking-api.svg?style=flat-square)](https://packagist.org/packages/ticaje/booking-api)
[![Blog](https://img.shields.io/badge/Blog-hectorbarrientos.com-magenta)](https://hectorbarrientos.com)

## Preface

This is a Middleware that uses Hexagonal Design pattern to connect Booking based solutions, that are defined on specific frameworks/platforms even PHP standalone based solutions, with Domain specific API.
This library creates the High Level Policies and standard Use Cases to Booking Domain Modeling.

## Installation

```bash
composer require ticaje/booking-api
```

## High Level Policies

A Booking business is about making reservations so the key domain objects to this are:

#### Subject of Booking: Hotel Room, Car etc. Let's call it from now on: Main Domain Resource.

This is the main value object to Booking domain. Is the main subject to model.

#### Calendar

The main context to value objects is the calendar cause booking means making reservations based on time(days, hours).
The policies defined in this domain component are related to enabled/disabled days or periods for a Calendar according to concrete Main
Domain Resource.

#### Prices

A reservation is subjected to the price a client must pay for that good or service.
There are a series of price rules to reservations that only belong to Domain grounds, and those policies depend on Calendar object,
and its policies are in alignment with Calendar's.
Our API defines basic/standard price rules that can be extended by consumers of this API.
The way our API calculates prices can be extended by stakeholders.

#### Availability

Pretty much like prices, availability is another Domain object that handles the current business in terms of booking occupations.
This domain component depends on Calendar object and its policies are in alignment with Calendar's.

## Use Cases

A use case is a Domain scenario that expects a System to fulfill specific business goal a specific actor needs hence its interaction with the system.
It has pre-conditions, post-conditions, business rules and process flow(normal and alternate).
Basically a Use Case represents a request to system by an actor where the system itself responds to such request based on business policies.
A high level system is built upon Use Cases for the sake of granularity and separation of concerns principle.

#### Example of Use Case

An example of a Use Case could be:

- Get availability for given business resource & specific date.
- Get price given for business resource & specific date.

### Low Level Detail Grounds

We have implemented a specific Use Case based approach that implies a hexagonal-based library called ticaje/hexagonal.
This library allows us to inject any Use-Case-based lower level library that orchestrates the machinery to handle Use Cases using the ___Bus/Command/Handler___ design pattern.

It may seem sophisticated and complicated at first blush but, it's actually just the opposite.
The idea behind ___Bus/Command/Handler___ is to create a Use Case and, accomplishing it by creating a Command, associate it to a Handler by using a Bus component that maps commands to handlers using a library like Tactician(the one we inject) to orchestrate the business model.
The Handler receives a business DTO that is interpreted whether in a Application Service or the handler itself.
In our current solution we have created Application Services so it can be consumed by external agencies without the need of Use Case approach.
The difference of using Use Case approach is that we can call it from any context by just instatiating a Command, passing it along to proper Bus method and, Handler does the rest.

## Fully Hexagonal

The DTO is the key to decouple the persistence of data from Domain objects cause is governed by an interface or service contract that seals the domain policy
to receive the data that Domain understands, so is responsibility of consumers to make proper transformations to a valid Type that Domain expects.

Also, it can be included in any platform or application cause is created independent from any infrastructure related agencies, it only depends on few low level libraries that has no great dependencies on rich agencies.

You can use it within the context of any Framework or platform, you are free to use Dependency Inversion(approach I recommend the most) or make manual instatiation(for standalone apps) which I do not recommend very much cause it could affect agile goals. The idea behind Hexagonal is to frame solutions using a DI framework or something like Laravel or Symfony that already include one out of the box.

