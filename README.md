# Asynchronous PHP in examples
### #slideless
 
### Denys Bulakh
- Web Software Developer since 2002
- CTO at Regiondo GmbH
- Principal Engineer at Jochen Schweizer Mydays Group
 

### Regiondo
#### Jochen Schweizer Mydays Group
- Booking software for Leisure activity providers
- PHP, MySQL, MongoDB, Elasticsearch, Magento
- NodeJS, ReactJS, Kafka, k8, AWS

# Asynchronious PHP

## Why?

#### PHP made synchronous

### Asynchronious execution
- Higher UI responsiveness
- Timers
- Repetitive processes
- Listeners 
- ...

#### Problem 

- Concurrent requests
- Blocking I/O
- DB deadlocks

#### Solution?
- Queuing 

### Parallel execution
- Process performance
- Faster input/output
- Importing/exporting
- ...

## How?
### Message broker
- RabbitMQ
- Amazon SQS
- Kafka

### ReactPHP
- Promises
- Event loop
- Child processes

### Swoole
- Coroutines
- Channels
- Multiprocessing

## Example project
### Step 1
`git checkout step-1`
- Promises
- React PHP

### Step 2
`git checkout step-2`
- EventLoop
- ChildProcess

### Step 3
`git checkout step-3`
- Refactor usage of EventLoop
- Promise any / all

### Step 4
`git checkout step-4`
- Swoole
- Coroutines

### Step 5
`git checkout step-5`
- Channels for sharing between the coroutines

### Step 6
`git checkout step-6`
- Swoole Server

### Thank you!

## Questions?
### Denys Bulakh
- denys@bulakhweb.com
- https://github.com/denisbulakh/ipc-2020-asyncphp-session
- https://www.linkedin.com/in/denysbulakh/

### Regiondo / Jochen Schweizer Mydays Group
- https://regiondo.com
- https://partner.jsmd-group.com
