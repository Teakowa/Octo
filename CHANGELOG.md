<a name="unreleased"></a>
## [Unreleased]

### Code Refactoring
- **Kugou:** album function method call change

    BREAKING CHANGE: album function is changed to class

    To migrate the code follow the example below:

    Before:

    ```php
    $kugou->album($id);
    ```

    After:

    ```php
    $kugou->album($id)->info();
    ```


<a name="v1.2.1"></a>
## [v1.2.1] - 2019-08-06
### Code Refactoring
- **Headers:** `__construct` not must required `$header` parameter,     it's can be null array `[]`
- **Provider:** move `Provider/API` to `Provider/Interfaces/API`
- **Provider:** use Interfaces

### Features
- **Headers:** add `getProvider` function, it's can be chosen provider headers by default 
   
   example: `$header = (new Headers())->getProvider('Tencent')`;
- **Interfaces:** add Artist, Album, Song Interface
- **Kugou:** add artist `pic` function example: `$kugou->artist($id)->pic();`

<a name="v1.2.0"></a>
## [v1.2.0] - 2019-08-04
### Code Refactoring
- **Global:** Providers class method's parameter position has change
BREAKING CHANGE: The parameters required by the provider class method's
    `$id` `$mid` are moved to providers class `__construct`

    To migrate the code follow the example below:

    Before:

	```php
    $kugou->artist()->info($id);
    $kugou->artist()->fans($id);
    $kugou->song()->info($hash);
    $kugou->song()->special($hash);
    $tencent->artist()->info($id);
    $tencent->album($mid)->pic();
    $tencent->song()->info($mid);
	```

    After:

	```php
    $kugou->artist($id)->info();
    $kugou->artist($id)->fans();
    $kugou->song($hash)->info();
    $kugou->song($hash)->special();
    $tencent->artist($id)->info();
    $tencent->album($mid)->pic();
    $tencent->song($mid)->info();
	```

### Features
- **Kugou:** update default header


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
[v1.2.0]: https://github.com/Teakowa/Octo/compare/v1.1.0...v1.2.0
[v1.2.1]: https://github.com/Teakowa/Octo/compare/v1.1.0...v1.2.1

[#1]: https://github.com/Teakowa/Octo/issues/1
[6019444]: https://github.com/Teakowa/Octo/commit/60194447c2d16f2f3a16978fda2a9ee28d3246b9