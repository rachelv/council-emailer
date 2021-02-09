Simple tool to attempt to make it easier to write good emails to city council.

https://emailcitycouncil.com

Getting this up and running:
1) Install Docker via the method of your choice
2) Check out the council-emailer repo into whatever directory you'd like
3) From the council-emailer directory, run `./vendor/bin/sail up` (Sail is Laravel's docker wrapper that makes starting up the app in a docker container super easy)
4) Build the assets (css & js): `./vendor/bin/sail npm run dev` (which just runs `npm run dev` in the docker container)
5) You should then be able to hit the app via http://localhost (which works by default) or http://dev.emailcitycouncil.com (which works because I added a dev A record that points to 127.0.0.1 to the emailcitycouncil.com DNS)

If you would like the change anything campaign specific, that info is here:
https://github.com/rachelv/council-emailer/blob/main/config/campaigns/racial-equity-plan.php

If you would like to change the email recipe itself, that is here (I was assuming the recipe would not change per-campaign, but the talking points and subject lines would):
https://github.com/rachelv/council-emailer/blob/main/config/council-emailer.php

If you would like to change any other text on the email form itself, that is here:
https://github.com/rachelv/council-emailer/blob/main/resources/views/campaign/index.blade.php
