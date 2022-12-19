## Test Playlists [/api/test/playlists/{territory}/{limit}]

### Test Playlists [GET]

+ Parameters
    + territory: `JP` (string, optional)
        + Default: `TW`
    + limit: `10` (integer, optional)
        + Default: `5`

+ Request (application/json)
    + Header

            access-token: {your-access-token}

- Response 200 (application/json)
    - Body

            {
                "data": [
                    {
                        "id": "abc123",
                        "name": "Playlists A",
                        "description": "test",
                        "url": "https://test.com",
                        "images": [
                            {
                                "height": 300,
                                "width": 300,
                                "url": "http://image.com",
                            },
                            {
                                "height": 600,
                                "width": 600,
                                "url": "http://image.com",
                            }
                        ],
                        "owner": {
                            "id": "abc456",
                            "url": "https://test.com",
                            "name": "王小明",
                            "description": "test",
                            "images": [
                            {
                                "height": 75,
                                "width": 75,
                                "url": "http://image.com",
                            },
                            {
                                "height": 180,
                                "width": 180,
                                "url": "http://image.com",
                            },
                            {
                                "height": 300,
                                "width": 300,
                                "url": "http://image.com",
                            }
                            ]
                        }
                    }
                ],
                "extra": {
                    "annotation": "test"
                }
            }