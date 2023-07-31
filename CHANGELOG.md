# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [5.0.0] - 2023-07-31

### Added
- **Breaking:** Add support for `DELETE` request method.\
This requires applications to implement `Application::createDeleteRouter()`
- **Breaking:** Add support for `PUT` request method.\
This requires applications to implement `Application::createPutRouter()`

## [4.3.0] - 2023-07-26

### Added
- `Request::hasHeader()` and `Request::getHeader()`
