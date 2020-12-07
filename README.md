# Asynchronous PHP in examples
### #slideless
 
### Denys Bulakh
- Web Software Developer since 2002
- CTO at Regiondo GmbH
- Principal Engineer at Jochen Schweizer Mydays Group
 

### Regiondo
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
