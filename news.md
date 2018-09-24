# hotfix 1.2.1
- September now included as a "summer month" for on peak/off peak analysis

## release 1.2.0
- Pi's can now read current with the current sensor to ADC to pi. 
- This needs a lot of cleaning up. It was a bit of a rush and it still needs to be cleanly integrated with pi website
- When configuring the sensor, one should put the voltage of the line in the wattage category. This will properly output the power of the line.
- Added testing framework for code. These can be fleshed out, they currently do a light test of Analyze.py
- Tests can be fairly easily added in the future. Additionlly, plan on removing unit test files from repository and downloading them during the unit test to save space.

## release 1.1.0
- Updated the peak times and added more peak times, including high, mid, low, and off peak
- Added different peak times for summer and winter seasons
- Updated the website to reflect the new rate structure
- Changed the pi-setup file for installing new packages and adjusting for the Pi 3
- Added new documents detailing the setup instructions for the hardware, software, and website