## Test Playlists Track [/playlists/test]

### Test Playlists Track [POST]

+ Request (application/x-www-form-urlencoded)

    + Body

            {
                'id' => 'abcde12345',
                'name' => 'Playlists A'
                'description' => 'Playlists A news'
                'image_url' => 'http://image.com'
                'annotation' => '註解'
            }

- Response 200 (application/json)
    - Body

            {
                'code' => 200,
                'msg' => 'success'
            }

- Response 001 (application/json)
    - Body

            {
                'code' => 001,
                'msg' => 'Data verification error'
            }

### Test Playlists Track [PUT]

+ Request (application/x-www-form-urlencoded)

    + Body

            {
                'id' => 'abcde12345',
                'annotation' => '註解'
            }

- Response 200 (application/json)
    - Body

            {
                'code' => 200,
                'msg' => 'success'
            }

- Response 001 (application/json)
    - Body

            {
                'code' => 001,
                'msg' => 'Data verification error'
            }

### Test Playlists Track [DELETE]
Delete Playlists
+ Request (application/x-www-form-urlencoded)

    + Body

            {
                'id' => 'abcde12345',
            }

- Response 200 (application/json)
    - Body

            {
                'code' => 200,
                'msg' => 'success'
            }

- Response 001 (application/json)
    - Body

            {
                'code' => 001,
                'msg' => 'Data verification error'
            }

- Response 002 (application/json)
    - Body

            {
                'code' => 002,
                'msg' => 'Data does not exist'
            }