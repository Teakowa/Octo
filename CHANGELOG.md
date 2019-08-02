<a name="unreleased"></a>
## [Unreleased]


<a name="v1.1.0"></a>
## [v1.1.0] - 2019-08-02
### Bug Fixes
- **Headers:** change `$headers` to private

### Code Refactoring
- **Kugou:** remove `__construct` `$url` `$adapter`, add `$this->header`
- **Kugou:** change from implements API to extends Kugou
- **Kugou:** add default header

### Features
- Finished Tencent API implementation.([#1])


<a name="v1.0.0"></a>
## v1.0.0 - 2019-08-01
### Bug Fixes
- **deps:** remove wrong license

### Features
- **Kugou:** Finished Kugou API implementation.([6019444])


[Unreleased]: https://github.com/Teakowa/Octo/compare/v1.1.0...HEAD
[v1.1.0]: https://github.com/Teakowa/Octo/compare/v1.0.0...v1.1.0

[#1]: https://github.com/Teakowa/Octo/issues/1
[6019444]: https://github.com/Teakowa/Octo/commit/60194447c2d16f2f3a16978fda2a9ee28d3246b9