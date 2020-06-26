# server2server
Communicate files from server A to send to be processed on server B, then return the result to server A because server A is hosted on an hosting platform that does not allow some third party libraries required for the processing

Master Branch: Server A
Other branch : Server B

Server A allows sending a file to server B and expect return of processed file from server B.
Currently, the only processing going on in server B is to just store the received files in a download folder on its server and return all the paths to the stored files to server A to confirm end to end communication
